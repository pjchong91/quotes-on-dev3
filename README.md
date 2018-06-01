# Project 5: Quotes on Dev
* Author: P. Chong, WDP Student 2018 Q2.

## Description and Objective: 
- Use Wordpress as a CMS.  Create a webpage using the Wordpress REST API to display quotes and fetch new quotes on button-click without refreshing the page.  Allow user to go back to previously displayed quotes.  Allow verified users to submit new quotes.  

## Using:
- Javascript(jQuery), Wordpress, and Gulp as preprocessor.

## Questions Encountered and Learning Acquired:
* Q - How can we fetch new quotes without page refresh?
    - By using javascript, we are call the ajax function on button click.  After retrieving information from the WP-JSON file, we can change change the html content inside specified elements without the page needing to reload.  Additionally, we can push the current page's slug onto the document url and log the previous page url in a variable.  This allows the user to use the 'back' button to return to a previously loaded quote.

* Ajax GET and POST, Endpoints and Routes
    - This page largely relied on using AJAX to GET data and to POST data.  In our javascript we provided an endpoint to posts at which ajax would GET (retrieve a post from /posts endpoint) or POST (add a submitted post to /posts endpoint).


## Goals for Future Improvement:
- Display other information such as categories or tags, such that users could find similar quotes from the front-page.


# Quotes on Dev Starter

This theme was built out from the starter-theme: Quotes on Dev provided by RED Academy( forked from Underscores ).

