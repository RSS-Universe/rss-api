$(document).ready(function () {
    const $logInModal = $('#LogInModal');
    const $ajaxModalSpinner = $('#ajaxModalSpinner');
    const $ajaxModalBody = $('#ajaxModalBody');
    const $ajaxModal = $('#ajaxModal');
    $("button[data-role='ajaxOpener']").click(function () {
        const isLoggedIn = Boolean($('body').data('authStatus'));
        const uri = $(this).data('uri');
        const authCheck = Boolean($(this).data('auth'));

        if (authCheck && !isLoggedIn) {
            return $logInModal.modal('show');
        }

        $ajaxModalBody.html('');
        $ajaxModalSpinner.addClass('d-flex').removeClass('d-none');
        $ajaxModal.modal('show');
        $.ajax({
            url: uri,
            type: 'get',
            success: function (response) {
                $ajaxModalSpinner.removeClass('d-flex').addClass('d-none');

                $ajaxModalBody.html(response);
                $ajaxModalBody.modal('handleUpdate')
            }
        });
    });
});
