<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Template Editor</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .editor-header {
            height: 55px;
            background: #1e1e1e;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-size: 18px;
            font-weight: bold;
        }

        #editor {
            width: 100%;
            height: calc(100vh - 55px);
        }

        .editor-header {
    height: 55px;
    background: #1e1e1e;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    font-size: 18px;
    font-weight: bold;
}

#saveBtn {
    background: #0d6efd;
    border: none;
    color: white;
    padding: 8px 18px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

#saveBtn:hover {
    opacity: 0.9;
}

#saveBtn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
    </style>
</head>

<body>

    <div class="editor-header">
    <div>Template Editor</div>

    <button id="saveBtn" type="button">
        Save
    </button>
</div>

    <div id="editor"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs/loader.min.js"></script>

   <script>
    require.config({
        paths: {
            vs: 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs'
        }
    });

    require(['vs/editor/editor.main'], function () {

        // Current file
        const fileName = @json($file);

        // Get file extension
        const extension = fileName.split('.').pop().toLowerCase();

        // Monaco language detection
        const languageMap = {
            html: 'html',
            htm: 'html',
            css: 'css',
            js: 'javascript',
            json: 'json',
            xml: 'xml',
            php: 'php'
        };

        const language = languageMap[extension] || 'plaintext';

        // Create Monaco Editor
        window.editor = monaco.editor.create(
            document.getElementById('editor'),
            {
                value: @json($content),
                language: language,
                theme: 'vs-dark',
                automaticLayout: true,
                minimap: {
                    enabled: true
                }
            }
        );

        const saveButton = document.getElementById('saveBtn');

        // ----------------------------------------
        // SAVE FUNCTION
        // ----------------------------------------

        function saveFile() {

            saveButton.disabled = true;
            saveButton.textContent = 'Saving...';

            fetch('{{ route('website.template-editor.save') }}', {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },

                body: JSON.stringify({
                    file: @json($file),
                    content: window.editor.getValue()
                })
            })

            .then(response => response.json())

            .then(data => {

                if (data.success) {

                    saveButton.textContent = 'Saved';

                    setTimeout(() => {
                        saveButton.textContent = 'Save';
                    }, 2000);

                } else {

                    alert(data.message || 'Unable to save file.');

                    saveButton.textContent = 'Save';
                }

            })

            .catch(error => {

                console.error(error);

                alert('Something went wrong while saving the file.');

                saveButton.textContent = 'Save';

            })

            .finally(() => {

                saveButton.disabled = false;

            });
        }


        // ----------------------------------------
        // SAVE BUTTON
        // ----------------------------------------

        saveButton.addEventListener('click', function () {
            saveFile();
        });


        // ----------------------------------------
        // CTRL + S
        // ----------------------------------------

        window.editor.addCommand(
            monaco.KeyMod.CtrlCmd | monaco.KeyCode.KeyS,
            function () {

                saveFile();

            }
        );

    });
</script>

</body>
</html>