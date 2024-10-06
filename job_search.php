<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%; /* Adjust container width */
            max-width: 800px; /* Add max-width */
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #2f00ca;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .job-box {
            background-color: #ffffff;
            border: 1px solid #000000;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px; /* Add extra space between card boxes */
            overflow-x: auto; /* Add horizontal scrollbar if content overflows */
            transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease; /* Add transition effect */
        }

        .job-box:hover {
            background-color: #e5f7e1; /* Change background color on hover */
            border-color: #ff0000; /* Change border color on hover */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Add shadow effect on hover */
        }

        .job-box b {
            color: #111111;
        }

        .job-box hr {
            border-color: #f60000;
            background-color: #45a049;
        }

        .company-url,
        .job-url a,
        .linkedin-job-url a {
            color: #007bff; /* Change link color */
            text-decoration: none; /* Remove underline */
            transition: color 0.3s ease; /* Add transition effect */
        }

        .company-url a:hover,
        .job-url a:hover,
        .linkedin-job-url a:hover {
            color: #ff0808; /* Change link color on hover */
        }

        /* CSS for image */
        .image-container {
            text-align: center;
        }

        .find-job-image {
            width: 50%; /* Adjust image width */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="findjob.gif" alt="Find Job Image" class="find-job-image">
    </div>
    <h1>Job Search</h1>
    <form action="" method="post">
        <label for="jobTitle">Job Title:</label><br>
        <input type="text" id="jobTitle" name="jobTitle"><br>
        <label for="jobLocation">Job Location:</label><br>
        <input type="text" id="jobLocation" name="jobLocation"><br><br>
        <input type="submit" value="Search">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searching_for_jobTitle = $_POST['jobTitle'];
        $job_in_country = $_POST['jobLocation'];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://linkedin-jobs-search.p.rapidapi.com/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'search_terms' => $searching_for_jobTitle,
                'location' => $job_in_country,
                'page' => '1'
            ]),
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: linkedin-jobs-search.p.rapidapi.com",
		        "X-RapidAPI-Key: b28726dae6msh9fdbfd71749b767p1878d2jsn9964c8e77d18",
		        "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $jsonObject = json_decode($response, true);

        if ($err) {
            echo "cURL Error: " . $err;
        } else {
            if ($response !== false) {
                foreach ($jsonObject as $data) {
                    echo "<div class='job-box'>";
                    echo "<div class='job-url'><b>Job URL:</b> <a href='" . $data['job_url'] . "' target='_blank'>" . $data['job_url'] . "</a></div>";
                    echo "<br>";
                    echo "<div class='linkedin-job-url'><b>LinkedIn Job URL:</b> <a href='" . $data['linkedin_job_url_cleaned'] . "' target='_blank'>" . $data['linkedin_job_url_cleaned'] . "</a></div>";
                    echo "<br>";
                    echo "<b>Company Name:</b> " . $data['company_name'] . "<br>";
                    echo "<br>";
                    echo "<div class='company-url'><b>Company URL:</b> <a href='" . $data['company_url'] . "' target='_blank'>" . $data['company_url'] . "</a></div>";
                    echo "<br>";
                    echo "<b>Job Title:</b> " . $data['job_title'] . "<br>";
                    echo "<br>";
                    echo "<b>Job Location:</b> " . $data['job_location'] . "<br>";
                    echo "<br>";
                    echo "<b>Posted Date:</b> " . $data['posted_date'] . "<br>";
                    echo "<br>";
                    echo "<b>Normalized Company Name:</b> " . $data['normalized_company_name'] . "<br>";
                    echo "</div>";
                }
            } else {
                echo "Error decoding JSON response.";
            }
        }

        curl_close($curl);
    }
    ?>

</div>

</body>
</html>
