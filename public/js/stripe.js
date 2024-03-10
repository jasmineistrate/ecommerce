const stripe = Stripe("pk_test_51OsKzECIXOl0WhuFCwddGTZjhCiGTro7V7dRlsIrz8smHguRMXMuSdpUAtS5SzpL7TxFoJeaJnXUlh9eFgODAqLa00d2xwaqnP");
const elements = stripe.elements();

// Set up Stripe.js and Elements to use in checkout form
const style = {
    base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4"
        }
    },
    invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
    },
};

const cardElement = elements.create('card', {
    hidePostalCode: true, // Hide the postal code (zip) field
    style,
});

cardElement.mount('#card-element');
const form = document.getElementById('checkout-form');
const button = document.getElementById('submit')
button.disabled = false;
form.addEventListener('submit', async (event) => {
    // We don't want to let default form submission happen here,
    // which would refresh the page.
    event.preventDefault();
    button.disabled = true;
    button.style.opacity = '0.7';
    const result = await stripe.createPaymentMethod({
        type: 'card',
        card: cardElement,
        billing_details: {
            // Include any additional collected billing details.
            name: 'Jenny Rosen',
        },
    })

    stripePaymentMethodHandler(result);
});

const stripePaymentMethodHandler = async (result) => {
    if (result.error) {
        // Show error in payment form
        const errorElement = document.getElementById('card-errors');
        errorElement.innerHTML = result.error.message;
        button.disabled = false;
        button.style.opacity = '1';
    } else {
        // Otherwise send paymentMethod.id to your server (see Step 4)
        const res = await fetch('/payment', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                payment_method_id: result.paymentMethod.id,
                address: document.getElementById('address').value,
                city: document.getElementById('city').value,
                country: document.getElementById('country').value
            }),
        })
        const paymentResponse = await res.json();
        // Handle server response (see Step 4)
        handleServerResponse(paymentResponse);
    }
}

const handleServerResponse = async (response) => {
    if (response.error) {
        const errorElement = document.getElementById('card-errors');
        errorElement.innerHTML = response.error;
        button.disabled = false;
        button.style.opacity = '1';
    } else if (response.requires_action) {
        console.log('requiresaction');
        // Use Stripe.js to handle the required card action
        const { error: errorAction, paymentIntent } =
            await stripe.handleCardAction(response.payment_intent_client_secret);

        if (errorAction) {
            const errorElement = document.getElementById('card-errors');
            errorElement.innerHTML = errorAction.message;
            button.disabled = false;
            button.style.opacity = '1';
        } else {
            // The card action has been handled
            // The PaymentIntent can be confirmed again on the server
            const serverResponse = await fetch('/payment', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ payment_intent_id: paymentIntent.id })
            });
            handleServerResponse(await serverResponse.json());
        }
    } else {
        window.location.href = '/payment/success';
    }
}