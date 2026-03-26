const fs=require('fs'); 
const p='resources/views/modules/school/school-management/index.blade.php'; 
let c=fs.readFileSync(p,'utf8'); 
c=c.replace(`        document.getElementById('classTitle').innerText = `Class ${classNumber} Student List`;\n        document.getElementById('searchInput').value = '';\n        function confirmDelete() {\n        if (confirm('Are you sure you want to delete this student?')) {\n            alert('Deleted (UI only)');\n        }\n    }\n\n    renderTable();\n    }`,`        document.getElementById('classTitle').innerText = `Class ${classNumber} Student List`;\n        document.getElementById('searchInput').value = '';\n        renderTable();\n    }\n\n    function confirmDelete() {\n        if (confirm('Are you sure you want to delete this student?')) {\n            alert('Deleted (UI only)');\n        }\n    }`); 
fs.writeFileSync(p,c);
