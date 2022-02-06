$(document).on('click', '.category-link', function(){
    if (!$('#catalog-data').length) {
        return true;
    }
    const self = $(this);
    $.ajax({
        url: '/index.php?page=categories&action=index&id=' + self.attr('link') + '&asAjax=true',
        type: 'GET',
        dataType: 'json'
    }).done(function(data) {
        const categoryList = $('<ul></ul>');
        const catalogData = $('#catalog-data');
        catalogData.empty();

        console.log('data = ' + JSON.stringify(data));

        for (let item in data.categories) {
            let category = $('<a>');
            category.attr('href', "/index.php?page=categories&id=" + data.categories[item].category_id);
            category.attr('link', data.categories[item].category_id);
            category.addClass('category-link');
            category.html(data.categories[item].name);
            categoryList.append('<li>' + category[0].outerHTML + '</li>');
        }
        catalogData.html(categoryList.html());
    });
    return false;
});
