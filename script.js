  async function loadNotes() {
    try {
      const response = await fetch('load_notes.php');
      const data = await response.json();
      if (data.error) {
        console.error('Error loading notes:', data.error);
        return;
      }
      const notes = data;
      const notesContainer = document.getElementById('notes');
      notesContainer.innerHTML = ''; // Clear existing notes
      notes.forEach(note => {
        const noteBox = document.createElement('div');
        noteBox.className = 'note';
        noteBox.dataset.id = note.id; // Store ID for potential delete

        const p = document.createElement('p');
        p.textContent = note.content;
        noteBox.appendChild(p);

        const del = document.createElement('button');
        del.textContent = 'Delete';
        del.style.marginTop = '5px';
        del.onclick = () => deleteNote(note.id, noteBox);
        noteBox.appendChild(del);

        notesContainer.appendChild(noteBox);
      });
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
      const result = await response.json();
      if (result.error) {
        console.error('Error saving note:', result.error);
      } else {
        console.log(result.success);
        document.getElementById('textInput').value = '';
        loadNotes(); // Reload notes after adding
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
      const result = await response.json();
      if (result.error) {
        console.error('Error deleting note:', result.error);
      } else {
        console.log(result.success);
        noteBox.remove(); // Remove from DOM
      }
    } catch (error) {
      console.error('Error deleting note:', error);
    }
    location.reload();
  }

  function addFile() {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    if (!file) return;

    const fileURL = URL.createObjectURL(file);

    const fileBox = document.createElement('div');
    fileBox.className = 'note';

    const link = document.createElement('a');
    link.textContent = `Fișier: ${file.name}`;
    link.href = fileURL;
    link.target = "_blank";

    fileBox.appendChild(link);

    if (file.type.startsWith('image/')) {
      const img = document.createElement('img');
      img.src = fileURL;
      img.style.maxWidth = '150px';
      img.style.display = 'block';
      img.style.marginTop = '5px';
      fileBox.appendChild(img);
    }

    const download = document.createElement('a');
    download.href = fileURL;
    download.download = file.name;
    download.textContent = "Descarcă";
    download.style.display = 'block';
    download.style.marginTop = '5px';
    fileBox.appendChild(download);

    document.getElementById('files').appendChild(fileBox);

    fileInput.value = '';
  }