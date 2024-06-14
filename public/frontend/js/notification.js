const toastLiveExample = document.getElementById('liveToast');

function showToast(message) {
  // console.log('Toast message:', message);
  if (toastLiveExample) {
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
      document.querySelector('#liveToast .toast-body').textContent = message;
      toastBootstrap.show();
  }
}

