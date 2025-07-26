function sendData (url, data, method = 'POST') {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: url,
      type: method,
      data: data,
      success: function (response) {
        resolve(response);
      },
      error: function (xhr, status, error) {
        reject(error);
      }
    });
  });
}