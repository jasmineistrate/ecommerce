let clickButton = document.getElementById('click-button');
let count = 0;
let showCount = document.getElementById('show-count');
function showCountValue(count)
{
    showCount.textContent = String(count);
}
clickButton.addEventListener('click', ()=>{
    count++;
    showCountValue(count);
})

console.log(showCount);