jQuery(document).ready(function () {
    // Get the ul that holds the collection of tags
    var $tagsCollectionHolder = $('.invoice');

    // add a delete link to all of the existing tag form li elements
    $tagsCollectionHolder.find('li').each(function () {
        if (!$tagsCollectionHolder.find('li').first()) {
            addTagFormDeleteLink($(this));
        }
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $tagsCollectionHolder.data('index', $tagsCollectionHolder.find('input').length);

    $('body').on('click', '.add_item_link', function (e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        // add a new tag form (see next code block)
        addFormToCollection($collectionHolderClass);
    })
});

function addFormToCollection($collectionHolderClass) {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $('.' + $collectionHolderClass);

    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var form = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // form = form.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    form = form.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(form);
    // Add the new form at the end of the list
    $collectionHolder.append($newFormLi)

    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);

}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button" class="btn btn-sm btn-danger mb-3"> <i class="fas fa-trash-alt"></i>Supprimer</button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function (e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}

function calcular() {

    var amount = $("input[id^=invoice_invoiceLines_][id$=_amount]:last").val();
    var quantity = $("input[id^=invoice_invoiceLines_][id$=_quantity]:last").val();
    var total_amount = parseFloat(amount) * parseFloat(quantity);
    var vat_amount = total_amount*(0.18);
    var total = total_amount+vat_amount;
    var total_invoice = $("input[id^=invoice_invoiceLines_][id$=_total]:last");
    var total_vat_amount = $("input[id^=invoice_invoiceLines_][id$=_vatAmount]:last");
    total_vat_amount.val(parseFloat(vat_amount));  
    total_invoice.val(parseFloat(total));

}