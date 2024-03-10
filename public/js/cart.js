function app(){
    return {
        //quantity:parseInt(document.getElementById('currentQuantity').textContent),
        totalPrice:null,
        updatePlusQuantity(id, quantity){
            let divQuantity = document.getElementById(id);
            if(quantity > 1000)
            {
                quantity = 1000;
            }
            else
            {
                quantity++;
            }
            axios.put('/update/quantity/cart/' + id,{
                quantity: quantity
            }).then(response => {
                divQuantity.textContent = quantity;
                this.setCart();
                window.location.href = window.location.href;
            })
        },
        updateMinusQuantity(id, quantity){
            let divQuantity = document.getElementById(id);
            if(quantity < 1)
            {
                quantity = 1;
            }
            else
            {
                quantity--;
            }
            axios.put('/update/quantity/cart/' + id,{
                quantity: quantity
            }).then(response => {
                divQuantity.textContent = quantity;
                this.setCart();
                window.location.href = window.location.href;
            })
        },
        setCart(){
            axios.get('/cart/total').then(response =>{
                //console.log(response.data);
                this.totalPrice = response.data;
                this.checkDiscount();
            })
        },
        setDiscount(){
            axios.post('/apply/discount');
        },
        removeDiscount(){
            axios.put('/remove/discount');
        },
        checkDiscount(){
            console.log(this.totalPrice);
            if(this.totalPrice > 2000)
            {
                this.setDiscount();
            }
            else
            {
                this.removeDiscount();
            }
        },
        init() {
            this.setCart();
        }
    }
}