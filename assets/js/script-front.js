(function($) {
    $(document).ready(function() {

        $(document).on('click', '.btn-add-notification', function() {
            let btn = $(this);
            let indicador_id = btn.attr('data-indicador-id');
            if (btn.hasClass('active')) {
                btn.removeClass('active');
                $('#form-notification-' + indicador_id).fadeOut(function() {
                    $('#meta-content-' + indicador_id).fadeIn();
                });
            } else {
                btn.addClass('active');
                $('#meta-content-' + indicador_id).fadeOut(function() {
                    $('#form-notification-' + indicador_id).fadeIn();
                });
            }

        }).on('click', '.filter-metas', function() {
            $('input[name=page]').val(1);
            pdiFront.filterMetas($(this));
        }).on('click', '.view-anos', function() {
            let indicador_id = $(this).attr('data-indicador-id')
            var div = $('#view-anos-' + indicador_id);
            if (div.hasClass('active')) {
                div.removeClass('active').fadeOut();
            } else {
                div.addClass('active').fadeIn();

            }
        }).on('click', '.select-ano', function() {
            let id = $(this).attr('data-indicador-id'),
                ano = $(this).attr('data-ano');

            $('#view-anos-' + id).fadeOut().removeClass('active');

            $('.data-ano-' + id + '.active').fadeOut(function() {
                $(this).removeClass('active');
                $('#data-ano-' + id + '-' + ano).fadeIn().addClass('active');
            })
            $('.indicador-percent-' + id + '.active').fadeOut(function() {
                $(this).removeClass('active');
                $('#indicador-percent-' + id + '-' + ano).fadeIn().addClass('active');
            })
            $('.indicador-chart-' + id + '.active').fadeOut(function() {
                $(this).removeClass('active');
                $('#indicador-chart-' + id + '-' + ano).fadeIn().addClass('active');
            })
        }).on('click', '.add-notification', function() {
            pdiFront.addNotification($(this));
        }).on('mouseenter', '.div-left', function() {
            var id = $(this).attr('data-indicador-id');
            $('.value-float-left-' + id).fadeIn(100);
        }).on('mouseout', '.div-left', function() {
            var id = $(this).attr('data-indicador-id');
            $('.value-float-left-' + id).fadeOut();
        }).on('mouseenter', '.div-right', function() {
            var id = $(this).attr('data-indicador-id');
            $('.value-float-right-' + id).fadeIn(100);
        }).on('mouseout', '.div-right', function() {
            var id = $(this).attr('data-indicador-id');
            $('.value-float-right-' + id).fadeOut();
        });

        $(document).on('click', '.add-comments', function() {
            pdiFront.addComments($(this));
        }).on('click', '.reply_comment', function() {
            comments.loadblockReply($(this));
        }).on('click', '.delete-comment', function() {
            comments.delete($(this));
        });

        /* Pagination */
        $(document).on('click', '.indicador-comments .pdi-pagination-btn, .indicador-comments .pdi-pagination-prev, .indicador-comments .pdi-pagination-next', function() {
            pagination.comments($(this));
        }).on('click', '.load-card-metas .pdi-pagination-btn, .load-card-metas .pdi-pagination-prev, .load-card-metas .pdi-pagination-next', function() {
            pagination.indicadores($(this));
        })

    });
})(jQuery);