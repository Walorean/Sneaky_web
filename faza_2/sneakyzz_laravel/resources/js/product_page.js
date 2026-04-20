document.querySelectorAll('.size-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
        document.getElementById('selected-shoe-id').value = this.dataset.shoeId;
        document.getElementById('selected-size').value = this.dataset.size;

        const stock = this.dataset.stock;
        const qtyInput = document.querySelector('.quantity-choose');
        qtyInput.max = stock;

        if (parseInt(qtyInput.value) > parseInt(stock)) {
            qtyInput.value = 1;
            document.getElementById('selected-quantity').value = 1;
        }
    });
});

document.querySelector('.quantity-choose').addEventListener('input', function () {
    document.getElementById('selected-quantity').value = this.value;
});

document.getElementById('add-to-cart-form').addEventListener('submit', function (e) {
    const shoeId = document.getElementById('selected-shoe-id').value;
    if (!shoeId) {
        e.preventDefault();
        alert('Please select a size first!');
    }
});
