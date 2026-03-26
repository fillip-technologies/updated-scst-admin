const fs=require('fs'); 
const p='resources/views/modules/school/school-management/index.blade.php'; 
let lines=fs.readFileSync(p,'utf8').split(/\r?\n/); 
const start=lines.findIndex(line= selectClass(classNumber) {')); 
const searchStart=lines.findIndex(line= searchStudent() {')); 
const repl=[ 
\"    function selectClass(classNumber) {\", 
\"        currentClass = classNumber;\", 
\"\", 
\"        document.querySelectorAll('.class-item').forEach((item) => {\", 
\"            item.classList.remove('bg-primary-900', 'text-white');\", 
\"            item.classList.add('text-gray-700', 'hover:bg-gray-100');\", 
\"        });\", 
\"\", 
\"        const activeClass = document.getElementById(`class${classNumber}`);\", 
\"        activeClass.classList.remove('text-gray-700', 'hover:bg-gray-100');\", 
\"        activeClass.classList.add('bg-primary-900', 'text-white');\", 
\"\", 
\"        document.getElementById('classTitle').innerText = `Class ${classNumber} Student List`;\", 
\"        document.getElementById('searchInput').value = '';\", 
\"        renderTable();\", 
\"    }\", 
\"\", 
\"    function confirmDelete() {\", 
\"        if (confirm('Are you sure you want to delete this student?')) {\", 
\"            alert('Deleted (UI only)');\", 
\"        }\", 
\"    }\", 
\"];\" 
lines=[...lines.slice(0,start), ...repl, ...lines.slice(searchStart)]; 
fs.writeFileSync(p,lines.join('\n'));
