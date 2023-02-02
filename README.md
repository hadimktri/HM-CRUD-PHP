# PHP

1. Project's Title: PHP CRUD Operations with JSON File

2. Project Description: CRUD operations in the web application are used to manage data dynamically. Generally, the data is stored and manipulated in the database.

Since the JSON file will be used to store data without using any database, a JSON file is required. In the “article.jason” directory, the JSON files will be created dynamically to store the articles information.
The Json class is a custom PHP library that handles all the CRUD-related operations (fetch, insert, update, and delete) with JSON file. Specify the directory where the JSON file will be stored and the name of the JSON file ($jsonFile).

getAllArticles() – Fetch records from the JSON file using file_get_contents() function in PHP.

saveArticle() – Store data into the JSON file using file_put_contents() function in PHP.

updateArticle() – Update existing data by ID in the JSON file.

deleteArticleById() – Remove a record from the JSON file by ID.

3. CRUD Operations with JSON (update_article.php)
The update_article.php file performs the edit and delet operations using PHP and JSON (Json handler class). The code is executed based on the requested action.

CRUD Operations with JSON (new_article.php)
The new_article.php file performs adding a new article operations using PHP and JSON (Json handler class). The code is executed based on the requested action.

4. In the article.php file, we will retrieve the records from the JSON file using Json class and list them in a tabular format with Add article, Edit article options.

The Add article  link redirects to the new_article.php page to perform the Create operation.

The Edit article redirects to the update_article.php page to perform the Update operation.

The Delete link redirects to the delete_article.php file with action_type=delete and id params. With the POST method, the record is deleted from the JSON file based on the unique identifier (id).

5. Included the style.css in CSS file of the Bootstrap library to manage some specific needs.

Bootstrap Library used to make the table, form, and buttons look better. You can omit it to use custom stylesheet for HTML table, form, buttons, and other UI elements.


