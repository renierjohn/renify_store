import QrScanner from "./qr-scanner.min.js";
QrScanner.WORKER_PATH = './js/qr-scanner-worker.min.js';

const video = document.getElementById('qr-video');
const camHasCamera = document.getElementById('cam-has-camera');
const camQrResult = document.getElementById('cam-qr-result');

function setResult(label, result) {
  console.log(result);
    if(result){
      label.textContent = result;
      camQrResultTimestamp.textContent = new Date().toString();
      scanner.stop()
    }

    label.style.color = 'teal';
    clearTimeout(label.highlightTimeout);
    label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
}

QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);
const scanner = new QrScanner(video, result =>setResult(camQrResult, result));
scanner.start();
scanner.setInversionMode('original');

// document.getElementById('inversion-mode-select').addEventListener('change', event => {
//     scanner.setInversionMode(event.target.value);
// });

// ####### File Scanning #######

// fileSelector.addEventListener('change', event => {
//     const file = fileSelector.files[0];
//     if (!file) {
//         return;
//     }
//     QrScanner.scanImage(file)
//         .then(result => setResult(fileQrResult, result))
//         .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
// });
