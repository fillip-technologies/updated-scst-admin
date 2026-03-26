const fs=require('fs'); 
const p='resources/views/modules/school/school-management/index.blade.php'; 
let c=fs.readFileSync(p,'utf8'); 
c=c.replace(`href=\"#\" class=\"inline-flex items-center px-3 py-1 rounded-md bg-green-50 text-green-700 border border-green-200 text-xs font-medium hover:bg-green-100 transition\"`,`href=\"{{ url('school-management/edit/1') }}\" class=\"inline-flex items-center px-3 py-1 rounded-md bg-green-50 text-green-700 border border-green-200 text-xs font-medium hover:bg-green-100 transition\"`); 
c=c.replace(`    renderTable();`,`    function confirmDelete() {\n        if (confirm('Are you sure you want to delete this student?')) {\n            alert('Deleted (UI only)');\n        }\n    }\n\n    renderTable();`); 
fs.writeFileSync(p,c);
