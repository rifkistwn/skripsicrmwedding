class Base64UploadAdapter {
  constructor(loader) {
      this.loader = loader;
  }

  upload() {
      return new Promise((resolve, reject) => {
          const reader = this.reader = new window.FileReader()

          // start::image validation
          reader.addEventListener('load', () => {
              const base64 = (reader.result.split("base64,")[1])
              const size = ((base64.length * (3 / 4) - 2) / 1024)
              const maxsize = 512

              if (size <= maxsize) {
                  resolve({ default: reader.result })
              } else {
                  toastr.error("Image size should be lower than 512kb.")
                  
                  reject()
              }
          });
          // end::image validation

          reader.addEventListener('error', err => {
              reject(err);
          });

          reader.addEventListener('abort', () => {
              reject();
          });

          this.loader.file.then(file => {
              reader.readAsDataURL(file);
          });
      });
  }

  abort() {
      this.reader.abort();
  }
}

export default function imageUploader(editor) {
  editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
      return new Base64UploadAdapter(loader)
  }
}