# Project 5: Quotes on Dev
* Author: P. Chong, WDP Student 2018 Q2.

## Description and Objective: 
- Use Wordpress as a CMS.  Create a webpage using the Wordpress REST API to display quotes and fetch new quotes on button-click without refreshing the page.  Allow user to go back to previously displayed quotes.  Allow verified users to submit new quotes.  

## Using:
- Javascript(jQuery), Wordpress, and Gulp and SCSS as preprocessor.

## Questions Encountered and Learning Acquired:
* Q - How can we fetch new quotes without page refresh?
    - With javascript, we are calling the ajax method on button click.  After retrieving information from the WP-JSON file, we can use html() to change the html within a specified element without requiring the page to reload.  Additionally, we can push the current page's slug onto the document url and log the previous page url in a variable.  This allows the user to use the 'back' button to navigate to a previously loaded quote.

* Ajax GET and POST, Endpoints (+custom endpoints) and Routes
    - This page largely relied on using AJAX to GET data and to POST data.  In the initial commits of this project,  our javascript provided an endpoint to /posts at which ajax would GET (retrieve a post from /posts endpoint) or POST (add a submitted post to /posts endpoint).  
    - The stretch goal of this project was to create a custom endpoint from which data could be fetched.  To create a custom endpoint in wordpress we hooked a function ('qod_register_endpoints')onto the 'rest_api_init' action.  From there we created a name space ('qod') and endpoint ('/rand').  Our function allows for a method of 'GET' and callback via 'get_random'.  I refactored my api.js to retrieve posts from the custom endpoint 'qod/rand' rather than 'posts' as this is considered to be better practice when utilizing custom data.

* REST API 
    - REST stands for REpresentational State Transfer.  The REST API allows us to easily view, manipulate, create, and search for information from our wordpress-site in JSON objects.

* Security and nonce
    - In this project, we were introduced to nonces and hashes which provide security and a form of validating permissions when the user tries to do certain interactions on a page.  A nonce/hash creates a string with the user's ID and a session token.  The hash verifies the user and allows the user to perform some activities.  For QOD, a user was required to be signed in to submit a quote.


## Goals for Future Improvement:
- Display other information such as categories or tags, such that users could find similar quotes from the front-page.
- I would like to learn more about security and to gain a clearer understanding of hashes and how they are processed.


# Quotes on Dev Starter

This theme was built out from the starter-theme: Quotes on Dev provided by RED Academy( forked from Underscores ).

