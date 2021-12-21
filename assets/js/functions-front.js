var pdiFront = {
    filterMetas: function(btn) {
        const form = btn.closest('form#filters-metas');
        var data = {
            action: 'pdi_filter_front_metas',
            form: form.serialize(),
            page: jQuery('input[name=page]').val(),
        };

        jQuery.ajax({
            type: 'POST',
            url: pdi_options_object.ajaxurl,
            data: data,
            dataType: 'html',
            beforeSend: function() {
                loadBlockFront.add(jQuery('.load-card-metas'));
            },
            complete: function() {
                loadBlockFront.remove();
            },
            success: function(response) {
                jQuery('.load-card-metas').html(response);
            }
        });
    },
    addNotification: function(btn) {
        const id = btn.attr('data-indicador-id'),
            form = jQuery('form#form-notification-' + id);

        var data = {
            action: 'pdi_add_notification',
            form: form.serialize(),
        };

        notificationBlock.remove();
        if (!form.find('.privacy-terms').is(':checked')) {
            notificationBlock.add(form, 'É necessário aceitar os Termos de Privacidade.', 'error');
            return false;
        }

        var valid = validadeForm.check(form)

        if (valid.status === false) {
            notificationBlock.add(form, valid.msg, 'error');
            return false;
        }

        jQuery.ajax({
            type: 'POST',
            url: pdi_options_object.ajaxurl,
            data: data,
            dataType: 'json',
            beforeSend: function() {
                loadBlockFront.add(form);
            },
            complete: function() {
                loadBlockFront.remove();
            },
            success: function(response) {
                if (response.status == 'error') {
                    notificationBlock.add(form, response.msg_error, 'error');
                } else {
                    notificationBlock.add(form, 'E-mail cadastrado com sucesso!', 'success');

                }
                console.log(response);
            },
        });
    },
    addComments: function(btn) {
        var form = btn.closest('form');

        notificationBlock.remove();

        if (jQuery.trim(form.find('#text-comment').val()) == '') {
            notificationBlock.add(form, 'O campo Comentário deve ser preenchido.', 'error');
            return false;
        }

        var data = {
            action: 'pdi_add_comments',
            form: form.serialize(),
        };

        jQuery.ajax({
            type: 'POST',
            url: pdi_options_object.ajaxurl,
            data: data,
            dataType: 'json',
            beforeSend: function() {
                loadBlockFront.add(form);
            },
            complete: function() {
                loadBlockFront.remove();
            },
            success: function(response) {
                form.find('textarea').val('');
                notificationBlock.add(form, 'Comentário inserido com sucesso!', 'success');
                comments.reloadComments(form.find('input[name=indicador_id]').val());
            },
        });
    },

}

var comments = {
    reloadComments: function(indicador_id) {

        var data = {
            action: 'pdi_comments_reload',
            indicador_id: indicador_id
        }

        jQuery.ajax({
            type: 'POST',
            url: pdi_options_object.ajaxurl,
            data: data,
            dataType: 'html',
            beforeSend: function() {

            },
            complete: function() {

            },
            success: function(response) {
                jQuery('.comments-previews').html(response);
            },
        });
    },
    loadblockReply: function(btn) {
        var indicador_id = btn.attr('data-indicador_id'),
            id_comment = btn.attr('data-comment-id');
        var block = '<form action=""><div class="form-row"><input type="hidden" name="indicador_id" value="' + indicador_id + '"><input type="hidden" name="comment_reply" value="' + id_comment + '"><div class="form-group col-md-12"><textarea name="text_comment" id="text-comment" rows="5" class="form-control"></textarea></div><div class="form-group col-md-12 button-comments"><button type="button" class="btn btn-primary add-comments">Enviar</button></div></div></form>';

        jQuery('.comment-reply-form.active').hide();

        var b = btn.closest('.comment-content').find('.comment-reply-form');
        if (b.attr('data-preview-reply') == 'true') {
            b.html('').hide().removeClass('active').attr('data-preview-reply', 'false');
        } else {
            b.html(block).show().addClass('active').attr('data-preview-reply', 'true');
        }
    },
    delete: function(btn) {
        var comment_id = btn.attr('data-comment-id'),
            indicador_id = btn.attr('data-indicador_id'),
            reply = btn.attr('data-reply');


        var data = {
            action: 'pdi_delete_comments',
            comment_id: comment_id,
            reply: reply,
        };

        jQuery.ajax({
            type: 'POST',
            url: pdi_options_object.ajaxurl,
            data: data,
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                console.log(response);
                btn.closest('.comment').fadeOut();
                comments.reloadComments(indicador_id);
            },
        });
    }
}

var pagination = {
    comments: function(btn) {
        var page = btn.attr('data-page'),
            indicador_id = btn.attr('data-indicador'),
            data = {
                action: 'pdi_pagination_comments',
                page: page,
                indicador_id: indicador_id,
            }

        jQuery.ajax({
            type: 'POST',
            url: pdi_options_object.ajaxurl,
            data: data,
            dataType: 'html',
            beforeSend: function() {

            },
            complete: function() {

            },
            success: function(response) {
                jQuery('.comments-previews').html(response);
            },
        });
    },
    indicadores: function(btn) {
        var page = btn.attr('data-page'),
            form = jQuery('form#filters-metas'),
            data = {
                action: 'pdi_pagination_indicadores',
                page: page,
                form: form.serialize(),
            };

        console.log(data);

        jQuery.ajax({
            type: 'POST',
            url: pdi_options_object.ajaxurl,
            data: data,
            dataType: 'html',
            beforeSend: function() {
                loadBlockFront.add(jQuery('.load-card-metas'));
            },
            complete: function() {
                loadBlockFront.remove();
            },
            success: function(response) {
                jQuery('.load-card-metas').html(response);
            },
        });
    }
}

var loadBlockFront = {
    add: function(local) {
        local.append('<div class="load-form"><i class="fas fa-cog fa-spin"></i>Aguarde...</div>');
    },
    remove: function() {
        jQuery('.load-form').remove();
    }
}
var notificationBlock = {
    add: function(local, texto, status) {
        console.log('aqui');
        local.append('<div class="col-md-12 return-notification ' + status + '">' + texto + '</div>');
    },
    remove: function() {
        jQuery('.return-notification').remove();
    }
}

var validadeForm = {
    check: function(form) {
        var id = form.attr('id');
        var r = true,
            msg = '',
            return_id = '';
        jQuery('#' + id + ' input, #' + id + ' select, #' + id + ' textarea').each(function(i, e) {
            var label = jQuery(this).closest('div').find('label');
            if (jQuery(this).prop('required') && (jQuery(this).val() == '' || !jQuery(this).val()) && jQuery(this).is(':visible')) {
                r = false;
                label.closest('.form-group').find('.msg-alert').html('Campo Obrigatório').removeClass('text-success').addClass('text-danger');
                jQuery(this).addClass('invalid');
                if (!return_id) {
                    return_id = jQuery(this).attr('id');
                    msg = 'Os campos obrigatórios (*) devem ser preenchidos';
                }
            } else if (jQuery(this).hasClass('input_invalid') && jQuery(this).val() != '') {
                r = false;
                jQuery(this).addClass('invalid');
                if (!return_id) {
                    return_id = jQuery(this).attr('id');
                    msg = 'Campo ' + $('label[for=for_' + jQuery(this).attr("id") + ']').html() + ' inválido';
                }
            } else {
                label.closest('.form-group').find('.msg-alert').html('').removeClass('text-danger').addClass('text-success');
                jQuery(this).removeClass('invalid');
            }
        });
        var ret = {
            status: r,
            error_id: return_id,
            msg: msg,
        };
        return ret;
    }
}