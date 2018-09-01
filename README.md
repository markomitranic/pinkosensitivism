# Pinkosensitivism Website

The website is supported on Docker containers, and using external nginx configuration.

## Crontab

For fetching new posts periodically, we use a dedicated command which can be run in isolation at anytime. We must bear in mind that the system is not backuped automatically, and API has only 20 of the latest posts available at any time.

```
0 */12 * * * php /usr/share/nginx/pinko/bin/console app:instagram:sync
```
Earlier it was `0,15,30,45 * * * *` but we changed to every 12 hours, since we are simply not using it that much.

## External Nginx

The docker ecosystem is self contained as far as the application is concerned, but we do need to use an external nginx proxy in order to make it available to the public, via SSL. The host machine uses an nginx entry similar to this:

```nginx
	server {
	    server_name pinkosensitivism.com;

	    root /var/www/pinko;

	    index index.php;

	    location ^~ / {
	        proxy_pass  http://pinkosensitivism.com:9877/;
	        proxy_set_header    Host                $host;
	        proxy_set_header    X-Real-IP           $remote_addr;
	        proxy_set_header    X-Forwarded-For     $proxy_add_x_forwarded_for;
	        proxy_set_header    X-Forwarded-Host    $host:9877;
	        proxy_set_header    X-Forwarded-Server  $host:9877;
	        proxy_set_header    X-Forwarded-Proto   https;
	        proxy_redirect off;
	        proxy_connect_timeout 90s;
	        proxy_read_timeout 90s;
	        proxy_send_timeout 90s;
	    }

	    listen 443 ssl; # managed by Certbot
	    ssl_certificate /etc/letsencrypt/live/pinkosensitivism.com/fullchain.pem; # managed by Certbot
	    ssl_certificate_key /etc/letsencrypt/live/pinkosensitivism.com/privkey.pem; # managed by Certbot
	    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
	    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

	}
	server {
	    if ($host = pinkosensitivism.com) {
	        return 301 https://$host$request_uri;
	    } # managed by Certbot


	    server_name pinkosensitivism.com;
	    listen 80;
	    return 404; # managed by Certbot


	}
```