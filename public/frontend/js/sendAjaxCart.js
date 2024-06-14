function sendAjaxCart(url, method, rowId, additionalData, onSuccess, onError) {
    var data = {
        _token: '{{ csrf_token() }}',
        rowId: rowId,
        ...additionalData // Nếu cần thêm dữ liệu khác
    };

    $.ajax({
        url: url,
        type: method,
        data: data,
        success: onSuccess,
        error: onError
    });
}
