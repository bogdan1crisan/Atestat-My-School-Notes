  function addNote() {
    const text = document.getElementById('textInput').value;
    if (text.trim() === '') return;

    const noteBox = document.createElement('div');
    noteBox.className = 'note';

    const p = document.createElement('p');
    p.textContent = text;
    noteBox.appendChild(p);

    const del = document.createElement('button');
    del.textContent = 'Șterge';
    del.style.marginTop = '5px';
    del.onclick = () => noteBox.remove();
    noteBox.appendChild(del);

    document.getElementById('notes').appendChild(noteBox);

    document.getElementById('textInput').value = '';
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