var dataTable = $('#list-table').DataTable({
    'pageLength': 25,
    'columnDefs': [ {
        'targets': 0,
        'orderable': false
    } ]
});


function getImg(){

    dataTable.rows().every(function () {
        var d = this.node();
        var tr = $(d);
        var element = $(tr.find('.img-cell')[0]);

        var priceCell = $(tr.find('.price-cell')[0]);

        var price = priceCell.data('price');
        var formattedPrice = accounting.formatMoney(parseFloat(price), "€", 2, ".", ",");
        priceCell.html(formattedPrice);
        $.ajax({
            type: "POST",
            url: "/includes/image-resize.php",
            data:  {
                original: element.attr('data-src'),
                width : 200
            },
            dataType: "html",
            success: function(result) {
                element.empty();
                element.append(result);
            }
        });


    });


}

function changePrice(type) {

    var addOnPrice = 0;
    if(type === 2) {
        addOnPrice = $('#xxl-price').val();
    } else if (type === 3){
        addOnPrice = $('#envelope-price').val();
    } else if (type === 4){
        addOnPrice = $('#premium-price').val();
    } else if (type === 5){
        addOnPrice = $('#xl-price').val();
    }

    dataTable.rows().every(function () {
        var d = this.node();
        var tr = $(d);
        var price = tr.data('price');
        var priceCell = $(tr.find('.price-cell')[0]);
        var newPrice = price + parseFloat(addOnPrice);
        var formattedPrice = accounting.formatMoney(parseFloat(newPrice), "€", 2, ".", ",");
        priceCell.html(formattedPrice);

    });
}



$('.dropdown-item').on('click', function (e) {
    e.preventDefault();
    var type = $(this).data('type');
    changePrice(type);


});



getImg();





