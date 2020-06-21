const classes = {
    wrapper: '.product-images-wrapper',
    addBtn: '.product-image-add',
    removeBtn: '.product-images-remove',
    row: '.product-images-row'
};
const htmlTemplate = `<div class="row product-images-row" style="width: 60%; margin: 32px auto 0;">
        <div class="col-8">
            <input type="file" name="products-images[]" />
        </div>
        <div class="col-4">
            <button class="btn btn-danger product-images-remove">Remove</button>
        </div>
    </div>`;

$(document).on('click', classes.addBtn, function(e) {
    e.preventDefault();
    $(classes.wrapper).append(htmlTemplate);
});

$(document).on('click', classes.removeBtn, function(e) {
    e.preventDefault();

    if($(this).hasClass('ajax')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        let route = $(this).data('route');
        let $btn = $(this);
        $.ajax({
            url: route,
            type: "DELETE",
            dataType: 'json',
            success: function (data) {
                let parent = $btn.parents(classes.row);
                parent.html(data.message);

                setTimeout(function (parent) {
                    parent.remove();
                },2000, parent);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    } else {
        let parent = $(this).parents(classes.row);

        if(parent) {
            parent.remove();
        }
    }
});
