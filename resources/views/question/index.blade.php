
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Callback - Promises - Async Function</title>
</head>
<body>
    <div>
        <p id="response_one"></p>
        <p id="response_two"></p>
        <p id="response_three"></p>
        <p id="response_four"></p>
    </div>
    <script src="{{asset('assets/jquery-3.7.1.js')}}"></script>
	<script type="text/javascript">
		// function getData(dataId)
		// {
		// 	return new Promise((resolve, reject) => {
		// 		setTimeout( () =>{
		// 			console.log("data", dataId);
		// 			resolve('success');
		// 		}, 2000);
		// 	});
		// }


		// async function getAllData()
		// {
		// 	await getData(1);
		// 	await getData(2);
		// 	await getData(3);
		// }

		// getAllData();

		function getData(question) {
		    return new Promise((resolve, reject) => {
		        
		        $.ajax({
		            url: "{{route('question.search')}}",
		            method: 'GET',
                    data: {
                        'question' : question
                    },
		            success: function(response) {
		                console.log("received:", response);
		                resolve(response); 
		            },
		            error: function(xhr, status, error) {
		                console.error('Error fetching data:', error);
		                reject(error); // Reject the promise with the error
		            }
		        });
		    });
		}

	async function getAllData() {
	    try {
	        const response1 = await getData('Who is the founder of Pakistan?');
	        const response2 = await getData('Who is the founder of India?');
	        const response3 = await getData('Who is the founder of PTI?');
	        const response4 = await getData('Who is Shaheed Bashir Khan Qureshi?');
            // console.log(response1.question.question);
            let response_one = document.getElementById('response_one');
            let response_two = document.getElementById('response_two');
            let response_three = document.getElementById('response_three');
            let responsefoure = document.getElementById('response_four');

            response_one.textContent = response1.question.question;
            response_two.textContent = response2.question.question;
            response_three.textContent = response3.question.question;
            responsefoure.textContent = response4.question.question;

	        console.log('All data received:', response1, response2, response3, response4);
	    } catch (error) {
	        console.error('Error getting all data:', error);
	    }
	}

	getAllData();

	</script>

</body>
</html>