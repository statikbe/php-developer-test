# PHP developer test
## Instructions
Using NASA’s “Astronomy Picture of the Day” API, build a webpage that lists the picture of the day for the last 30 days.

### Basic

:white_check_mark: An overview page that lists the picture of the day for the last 30 days.
:white_check_mark: A detail page with the date, picture and description for each picture.

### Extra's
:white_check_mark: Save the API response to a database and use that to build your webpage.
:white_check_mark: Make it possible to like a picture and show the like count per picture.
:white_check_mark: Sort the pictures by number of likes.

## Getting started
Fork this repo to your own Github account and commit your work there.

NASA’s API can be found [here](https://api.nasa.gov/#apod), the API you’ll need for this test is the “APOD”. You can use an API key to authenticate, but the DEMO_KEY should also work.

Your repo needs to include at minimum anything required to get the app working. Detailed instructions to setup and run the app should be provided in the README.md file.

:arrow_forward: Instructions:
- Copy folder called 'goedele' to file system
- Create db named 'laravel_nasa', with UN = 'statik', PW = 'veryveryverydifficultpassword'. (or change db parameters in .env if you want to use different credentials)
- import sql you find inside folder 'db' into newly created db  
- surf to <base_path>/goedele/public for the home page
- enjoy this amazing app

Feel free to use whichever framework you feel most comfortable with (but it needs to be PHP since that's what we're testing).

# Bonus points
:white_check_mark: Make it look good
:white_check_mark: Make it as object-oriented as possible
:white_check_mark: Manage your dependencies with Composer
:white_check_mark: If you have frontend assets, use a build tool like webpack or gulp to compile them
