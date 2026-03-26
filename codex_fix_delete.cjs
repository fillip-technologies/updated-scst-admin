const fs=require('fs'); 
const p='resources/views/modules/school/school-management/index.blade.php'; 
let c=fs.readFileSync(p,'utf8'); 
c=c.replace(`<button type=\"button\"`,`<button type=\"button\" onclick=\"confirmDelete()\"`); 
fs.writeFileSync(p,c); 

