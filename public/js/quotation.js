document.addEventListener("DOMContentLoaded", () => {
    const quoteForm = document.getElementById("quoteForm");
    const submitButton = document.getElementById("submit-button");
    const uploadStatus = document.getElementById("upload-status");
    const progressBar = document.querySelector(".progress");
    const progressBarInner = document.getElementById("progress-bar");
    const fileError = document.getElementById("file-error");

    quoteForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        submitButton.disabled = true;
        submitButton.textContent = "Submitting...";
        uploadStatus.innerHTML = "";
        fileError.textContent = "";
        progressBar.style.display = "block";
        progressBarInner.style.width = "0%";
        progressBarInner.textContent = "0%";

        const formData = new FormData(quoteForm);
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/api/submit-simplified-quote', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422 && data.errors) {
                    fileError.textContent = data.errors.file ? data.errors.file[0] : '';
                    uploadStatus.innerHTML = `<div class="alert alert-danger">Please fix the errors above.</div>`;
                } else {
                    throw new Error(data.message || "An unknown error occurred.");
                }
            } else {
                progressBarInner.style.width = "100%";
                progressBarInner.textContent = "100%";
                uploadStatus.innerHTML = `<div class="alert alert-success">Success! Your file has been uploaded. URL: <a href="${data.url}" target="_blank">View File</a></div>`;
                quoteForm.reset();
            }
        } catch (error) {
            console.error("Submission failed:", error);
            uploadStatus.innerHTML = `<div class="alert alert-danger">Submission Failed: ${error.message}</div>`;
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = "Submit Quote Request";
        }
    });
});
