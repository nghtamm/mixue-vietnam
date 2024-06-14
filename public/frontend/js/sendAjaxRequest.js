function sendAjaxRequest(url, method, data, onSuccess, onError) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: onSuccess,
        error: onError,
    });
}
