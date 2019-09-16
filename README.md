# Pinkosensitivism Website

The website is supported on Docker containers, and using external nginx configuration.

## Crontab

For fetching new posts periodically, we use a dedicated command which can be run in isolation at anytime. We must bear in mind that the system is not backuped automatically, and API has only 20 of the latest posts available at any time.

```
0 */12 * * * php /usr/share/nginx/pinko/bin/console app:instagram:sync
```
Earlier it was `0,15,30,45 * * * *` but we changed to every 12 hours, since we are simply not using it that much.

## Auth Token
Because of idiotic rules Instagram currently oppresses us with, i have to be logged in as the sandbox user, and visit the `https://pinkosensitivism.com/api/instagram/auth/{silly_pass}` route. The silly pass is simply always a password that is provided via env vars. After visiting the EP, instagram will redirect us to our EP to continue anc properly cache the token for a year. 
