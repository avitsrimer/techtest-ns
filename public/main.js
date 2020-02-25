"use strict";

$(document).ready(function () {
    let bindClickEvent = () => {
        $('.card-header > .new').on('click', function () {
            if ($(this).hasClass('new')) {
                $(this).closest('.card-header').addClass('inprogress');
                ajaxNodeLoader($(this).attr('data-node-id'));
                $(this).removeClass('new');
            }
        });
    };
    bindClickEvent();
    let ajaxNodeLoader = (id) => {
        const parentTemplate = (node_id, innerHtml) => {
            return "<div id=\"collapse-" + node_id + "\" class=\"collapse show\" data-parent=\"#accordion-" + node_id + "\" aria-labelledby=\"heading-" + node_id + "\"><div class=\"card-body\"><div id=\"accordion-" + node_id + "\">" + innerHtml + "</div></div></div>";
        };
        const renderChilds = (parent_id, nodesHtml) => {
            let parentCard = $('#card-' + parent_id);
            if (nodesHtml.length > 1) {
                parentCard.append(parentTemplate(parent_id, nodesHtml));
            } else {
                parentCard.find('.card-header').html(parentCard.find('a').html());
            }
        };
        $.ajax({
            type: 'GET',
            url: "/tree/ajax/" + id,
            dataType: 'html',
            async: true,
            success: function (data) {
                renderChilds(id, data);
                $('#heading-' + id + ' a').attr('aria-expanded', true);
                bindClickEvent();
                $('#heading-' + id).closest('.card-header').removeClass('inprogress');
            }
        });
    };
});