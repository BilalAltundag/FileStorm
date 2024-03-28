# File Upload Platform

This project is a web application where users can upload and store their files. It also includes a profile page where users can edit their profiles.
![Ekran Alıntısı](https://github.com/BilalAltundag/FileStorm/assets/50177921/56f77b0d-6a47-4a32-a49f-756df107fd63)

![Ekran Alıntısı3](https://github.com/BilalAltundag/FileStorm/assets/50177921/af4f7331-1ea9-4917-b71c-14242813559a)

## How It Works

This web application is written in PHP and uses MySQL database. Users need a file server and a database server to upload their files.

1. Upload the project files to a web server or localhost.
2. Import the `db.sql` file into your MySQL database to create the necessary tables.
3. Edit the `db.php` file to update your database connection information.
4. Access the application by opening the `index.php` file in your web browser.

## Usage with AWS S3

If you want to store your files on AWS S3, follow these steps:

1. Go to the AWS Management Console and create an S3 bucket.
2. Create access keys using AWS IAM.
3. Edit the `upload.php` file to add your AWS S3 access keys and bucket information.
4. Your file upload operations will now be stored on AWS S3.

## License

This project is licensed under the MIT License. For more information, see the LICENSE file.

## Contribution

If you find any bugs or want to contribute to the project, please submit a pull request or open an issue.

## Contact

- Email: bilalaltundag2000@gmail.com
- Project Link: [GitHub](https://github.com/BilalAltundag/FileStorm)

This README file provides basic information on how to use the project. For more details, please explore the project files.
