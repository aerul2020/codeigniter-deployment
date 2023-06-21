/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

const video = document.getElementById("my-video");
const btnCapture = document.getElementById("btn-capture");
const btnUpload = document.getElementById("btn-upload");

//const token = document.getElementById("token").value;
const startVideo = () => {
    navigator.mediaDevices
        .getUserMedia({
            video: {},
        })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((err) => console.error(err));
};

const facesData = [];
let faceDescriptions = [];
let countHelper = 0;

/* Load all models */
Promise.all([
    faceapi.loadSsdMobilenetv1Model(BASE_URL + "/assets/models"),
    faceapi.loadFaceRecognitionModel(BASE_URL + "/assets/models"),
    faceapi.loadFaceLandmarkModel(BASE_URL + "/assets/models"),
]).then(startVideo);

const detectFaces = async () => {
    const canvas = faceapi.createCanvasFromMedia(video);
    const target = document.getElementById("target-video");
    const displaySize = {
        width: video.offsetWidth,
        height: video.height,
    };

    canvas.setAttribute("id", "canvas-layer");
    target.append(canvas);
    faceapi.matchDimensions(canvas, displaySize);

    //const labels = await faceMatcher();

    setInterval(async () => {
        const detections = await faceapi
            .detectSingleFace(video)
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (detections !== null & typeof detections !== 'undefined') {
            const score = detections.detection.score;
            
            if(score >= 0.8 && countHelper < 10) {
                faceDescriptions.push(detections.descriptor);
                countHelper++;
            }
            
            //Draw detected face
            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
            faceapi.draw.drawDetections(canvas, resizedDetections);
        } else {
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
        }

        if(countHelper == faceDescriptions.length && countHelper === 10) {
            stopVideo();

            const kodePegawai = document.querySelector("input[name=kode_pegawai]").value;
            const faceDesciptor = new faceapi.LabeledFaceDescriptors(kodePegawai, faceDescriptions);
            const faceData = JSON.stringify(faceDesciptor);
            document.querySelector("input[name=data]").value = faceData;
        }
    }, 100);
};

//video.addEventListener("play", detectFaces);
btnCapture.addEventListener('click', detectFaces);

const stopVideo = () => {
  video.pause();
  navigator.mediaDevices
    .getUserMedia({
      video: {},
    })
    .then((stream) => {
      stream.getTracks().forEach((track) => track.stop());
    })
    .catch((err) => console.error(err));

  btnCapture.setAttribute('disabled', 'disabled');
  btnUpload.removeAttribute('disabled');
};