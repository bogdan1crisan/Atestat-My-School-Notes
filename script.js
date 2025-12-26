  async function loadNotes() {
    try {
      const response = await fetch('load_notes.php');
      const data = await response.text();
      if (data.startsWith("error:")) {
        console.error('Error loading notes:', data);
        return;
      }
      const notesContainer = document.getElementById('notes');
      notesContainer.innerHTML = data;
    } catch (error) {
      console.error('Error loading notes:', error);
    }
  }

  async function addNote() {
    const text = document.getElementById('textInput').value;
    if (text.trim() === '') return;

    try {
      const response = await fetch('save_note.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          'content': text
        })
      });
      const result = await response.text();
      if (result === "success") {
        document.getElementById('textInput').value = '';
        loadNotes();
      } else {
        console.error('Error saving note:', result);
      }
    } catch (error) {
      console.error('Error saving note:', error);
    }
    location.reload();
  }

  async function deleteNote(id, noteBox) {
    try {
      const response = await fetch('delete_note.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          'id': id
        })
      });
      const result = await response.text();
      if (result === "success") {
        noteBox.remove();
      } else {
        console.error('Error deleting note:', result);
      }
    } catch (error) {
      console.error('Error deleting note:', error);
    }
    location.reload();
  }

  async function loadFiles() {
    try {
      const response = await fetch('load_files.php');
      const data = await response.text();
      if (data.startsWith("error:")) {
        console.error('Error loading files:', data);
        return;
      }
      const filesContainer = document.getElementById('files');
      filesContainer.innerHTML = data;
    } catch (error) {
      console.error('Error loading files:', error);
    }
  }

  function addFile() {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('file', file);

    fetch('upload_file.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(result => {
      if (result === "success") {
        loadFiles();
      } else {
        console.error('Error uploading file:', result);
      }
    })
    .catch(error => {
      console.error('Error uploading file:', error);
    });

    fileInput.value = '';
  }

  async function deleteFile(id, fileBox) {
    try {
      const response = await fetch('delete_file.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          'id': id
        })
      });
      const result = await response.text();
      if (result === "success") {
        fileBox.remove();
      } else {
        console.error('Error deleting file:', result);
      }
    } catch (error) {
      console.error('Error deleting file:', error);
    }
    location.reload();
  }