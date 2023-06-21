/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

const video = document.getElementById("my-video");
const btnTestRecognize = document.getElementById("btn-test-recognize");
const startTestingAction = document.getElementById("start-testing-action");
const endTestingAction = document.getElementById("end-testing-action");
const currentKodePegawai = document.getElementById("kode-pegawai").value;
const currentNamaPegawai = document.getElementById("kode-pegawai").value;
const resultRecognizeRows = document.getElementById("result-recognize-rows");
let countHelper = 1;

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


const faceMatcher = async () => {
    const labeledFaceDescriptors = await Promise.all(
        FACES_MODELS.map((kode) => {
            kode = JSON.parse(kode);
            const descriptors = [];
                for (let i = 0; i < kode.descriptors.length; i++) {
                    descriptors.push(new Float32Array(kode.descriptors[i]));
                }
            return new faceapi.LabeledFaceDescriptors(kode.label, descriptors);
        })
    );
  return new faceapi.FaceMatcher(labeledFaceDescriptors, 0.8);
};

/* Load all models */
Promise.all([
    faceapi.loadSsdMobilenetv1Model(BASE_URL + "/assets/models"),
    faceapi.loadFaceRecognitionModel(BASE_URL + "/assets/models"),
    faceapi.loadFaceLandmarkModel(BASE_URL + "/assets/models"),
]).then(startVideo);

const doRecognize = async () => {
    if(video.paused) {
        countHelper = 1;
        video.play();
        resultRecognizeRows.innerHTML = '';
    }
    const canvas = faceapi.createCanvasFromMedia(video);
    const target = document.getElementById("target-video");
    const displaySize = {
        width: video.offsetWidth,
        height: video.height,
    };

    canvas.setAttribute("id", "canvas-layer");
    target.append(canvas);
    faceapi.matchDimensions(canvas, displaySize);

    const labels = await faceMatcher();

    setInterval(async () => {
        const detections = await faceapi
            .detectSingleFace(video)
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (detections !== null & typeof detections !== 'undefined') {            
            //Draw detected face
            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            const result = labels.findBestMatch(detections.descriptor);

            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
            faceapi.draw.drawDetections(canvas, resizedDetections);

            const box = resizedDetections.detection.box;
            const { label, distance } = result;
            const namaPegawai = DAFTAR_PEGAWAI[label];
            const distanceResult = 100 - parseInt(distance * 100, 10);

            let rowClass = "", keterangan = "Valid";
            if(label !== currentKodePegawai && namaPegawai !== currentNamaPegawai) {
                rowClass = `class="bg-danger text-white font-weight-bold"`;
                keterangan = 'Tidak valid';
            } else {
                rowClass = "";
            }

            const rowData = `<tr ${rowClass}>
                                <td>${countHelper}</td>
                                <td>${label}</td>
                                <td>${namaPegawai}</td>
                                <td>${distanceResult}</td>
                                <td>${keterangan}</td>
                            </tr>`;

            if(countHelper <= 20) {
                resultRecognizeRows.innerHTML += rowData;
                countHelper++;
            }

            new faceapi.draw.DrawBox(box, {label: namaPegawai}).draw(canvas);

        } else {
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
        }

        if(countHelper === 20) {
            stopVideo();

            endTestingAction.classList.remove("hidden");
            btnTestRecognize.innerText = "Ulangi Uji Coba Pengenalan Wajah";
            //startTestingAction.classList.add("hidden");
        }

    }, 100);
};

//video.addEventListener("play", doRecognize);
btnTestRecognize.addEventListener('click', doRecognize);

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
};