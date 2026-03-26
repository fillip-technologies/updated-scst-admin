const fs=require('fs'); 
const p='routes/web.php'; 
let c=fs.readFileSync(p,'utf8'); 
c=c.replace(`Route::get('/school-management/bulk-upload', function () {\n    return view('modules.school.school-management.bulk-upload');\n});`,`Route::get('/school-management/bulk-upload', function () {\n    return view('modules.school.school-management.bulk-upload');\n});\n\nRoute::get('/school-management/edit/{id}', function ($id) {\n    return view('modules.school.school-management.edit');\n});`); 
fs.writeFileSync(p,c);
