<style>
    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border-left-color: #fff;
        animation: spin 1s ease infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: flex; flex-direction: column; align-items: center;">
        <div class="spinner" style="margin-bottom: 10px"></div>
        <p style="color: white; text-align: center;">Đơn hàng đang được xử lý, vui lòng chờ...</p>
    </div>
</div>
