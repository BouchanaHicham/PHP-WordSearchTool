# PHP Word Search Tool

The PHP Word Search Tool is a powerful and flexible application that allows users to search for specific words in a database and perform various logical operations to refine their search results. It is particularly useful for projects involving text analysis, document retrieval, and information retrieval tasks.

## Features

- **Word Search:** Easily search for specific words in the provided database.
- **Logical Operations:** Perform logical operations (AND, OR, NOT) to combine multiple search terms and refine search results.
- **Database Integration:** Seamlessly integrate with a MySQL database to store word entries and document IDs.
- **Search Results:** Display search results with document IDs and their corresponding occurrences for easy analysis.

## How to Use

1. **Clone the Repository:** Start by cloning this repository to your local machine using `git clone`.

2. **Configure Database Connection:** In the `Tables_Page.php` file, update the database connection settings to match your XAMPP MySQL credentials and database name.

3. **Create Database Tables:** Use PHPMyAdmin or any MySQL management tool to create the required tables with the specified structure in the database.

4. **Upload Files:** Upload the relevant files that you want the database to save and perform searches on. Ensure that the files are supported and compatible with the PHP Word Search Tool.

5. **Run the PHP Script:** Host the PHP script on your local XAMPP server. You can do this by copying the project files into the appropriate directory inside your XAMPP `htdocs` folder. Then, access the tool through your web browser by navigating to `http://localhost/path/to/your/project/site.html`.

6. **Enter Your Search Query:** On the web page, enter the word(s) you want to search for in the provided input box and click "Search."

7. **View Search Results:** The PHP Word Search Tool will display the search results, including document IDs and their corresponding occurrences for easy analysis.

8. **Optional - Use Var_Masterpiece Chrome Extension:** For a more convenient and visual representation of the linked list's structure, you can install the Var_Masterpiece Chrome extension. This extension helps you visualize and analyze the nodes' connections, making it easier to understand the search logic and refine your queries effectively.

By following these steps, you can utilize the PHP Word Search Tool to efficiently search for specific words in your uploaded files and perform various logical operations to refine your search results. Enjoy exploring and analyzing your text data with this powerful and flexible application!

## Note

Make sure to check the compatibility of the file formats you upload with the PHP Word Search Tool. The tool currently supports specific file types, and unsupported formats may not be processed correctly. Additionally, ensure that the uploaded files contain textual data for accurate search results.


## Code Explanation

The core functionality of the PHP Word Search Tool is implemented using PHP and MySQL. The heart of the application lies in the `LinkedList` class, which handles search operations and logical calculations. It efficiently traverses the linked list, performs search operations, and applies logical operators to generate accurate search results.

## Requirements

To use the PHP Word Search Tool, you need the following:

- **PHP:** PHP 7.x or later installed on your local machine.
- **XAMPP:** Install XAMPP, a popular PHP development environment, to host the PHP script. You can download XAMPP from the official website: [https://www.apachefriends.org](https://www.apachefriends.org)
- A MySQL database set up with tables to store word entries and document IDs.
- **Var_Masterpiece** Chrome extension for visualizing the linked list structure [Get it here](https://chrome.google.com/webstore/detail/varmasterpiece/chfhddogiigmfpkcmgfpolalagdcamkl).
## Database Setup

To use the PHP Word Search Tool, you need to set up a MySQL database with the following structure:

### Database Name: words_data_base

#### Table: doc_id

Columns:
- Doc_Name	(VARCHAR)
- Id	(INT)

#### Table: words_entry

Columns:

- Doc_Id (INT)
- rep (INT)
- word (VARCHAR)

![DataBase Structure](https://github.com/BouchanaHicham/PHP-WordSearchTool/blob/main/Examples/Database_Structure.png)

Ensure that you have MySQL installed and running on your local machine. You can use tools like PHPMyAdmin or MySQL Workbench to create the database and tables.

After setting up the database, you should update the `Tables_Page.php` file in the project to configure the database connection settings to match your XAMPP MySQL credentials and the database name you just created.

## Example
![Site Ui](https://github.com/BouchanaHicham/PHP-WordSearchTool/blob/main/Examples/Site_UI.png)
![Search query](https://github.com/BouchanaHicham/PHP-WordSearchTool/blob/main/Examples/query(smart_house).png)
![use of var_masteripiece extension](https://github.com/BouchanaHicham/PHP-WordSearchTool/blob/main/Examples/use_of_var_masterpiece.png)


## License

This project is licensed under the MIT License. You can find the full text of the license in the [LICENSE](LICENSE) file.

## Contributions

Contributions to this project are more than welcome. If you have any suggestions, bug fixes, or new features to add, please feel free to fork the repository and submit a pull request. We value your feedback and contributions!

## Author

**Bouchana Hicham**
