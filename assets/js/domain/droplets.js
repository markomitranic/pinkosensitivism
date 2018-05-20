jQuery(document).ready(function() {
    (function($){

        let $svg = document.getElementById('desktop-droplet'),
            $goo = $svg.getElementById('goo'),
            $path = $svg.getElementById('mirror'),
            $circle = $svg.getElementById('circle'),
            canvasSizeX = 1680,
            canvasSizeY = 800,
            dropletXLimit = 500,
            dropletYLimit = 250,
            elasticness = 0.2,
            curveX = 0,
            curveY = 0,
            circleRadius = 100;

        const easing = {
            easeInCubic: t => t ** 3,
            easeOutCubic: t => (--t) * t ** 2 + 1,
            easeInOutCubic: t => t < 0.5 ? 4 * t ** 3 : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1
        };

        function resetCanvasSize() {
            $svg.setAttribute('width', window.innerWidth);
            $svg.setAttribute('height', window.innerHeight);
            $goo.setAttribute('width', window.innerWidth);
            $goo.setAttribute('height', window.innerHeight);
            canvasSizeX = window.innerWidth;
            canvasSizeY = window.innerHeight;
            dropletXLimit = window.innerWidth;
            dropletYLimit = window.innerHeight;
        }

        function resetDropletPath() {
            let points = [
                'M0,0', // moveTo
                'V' + canvasSizeY, // verticaLine
                'Q' + curveX + ',' + curveY + ' ' + canvasSizeX + ',0', // curveTo QcurveX,curveY targetX,targetY
                'Z' // closePath
            ];
            $path.setAttribute('d', points.join(' '));
        }

        function moveCircle(x, y) {
            const limit = (window.innerHeight - circleRadius);

            if (y > limit) {
                y = limit;
            }

            $circle.setAttribute('cx', x);
            $circle.setAttribute('cy', y);
        }

        function startBounceAnimation() {
            removeBounceEventListeners();
            let start;
            const duration = 1250;

            const animation = timestamp => {
                if (!start) {
                    start = timestamp;
                }

                const progress = timestamp - start;
                const amplitude = 100 - easing.easeOutCubic(progress / duration) * 100;
                const time = 3 * (progress / duration);
                const y = amplitude * Math.cos(6.283185 * time);

                curveY = 100 + y;
                resetDropletPath();

                if (progress < duration) {
                    requestAnimationFrame(animation);
                } else {
                    addBounceEventListeners();
                }
            };

            requestAnimationFrame(animation);
        }

        function mouseMoveEventListener (e) {
            curveX = (e.clientX > dropletXLimit) ? dropletXLimit + ((e.clientX - dropletXLimit) * elasticness) : e.clientX;
            curveY = (e.clientY > dropletYLimit) ? (dropletYLimit + ((e.clientY - dropletYLimit) * elasticness)) : e.clientY;
            resetDropletPath();
            moveCircle(e.clientX, e.clientY);
        }

        function addBounceEventListeners() {
            window.addEventListener('click', startBounceAnimation);
        }

        function removeBounceEventListeners() {
            window.removeEventListener('click', startBounceAnimation);
        }

        function init() {
            if (window.innerWidth <= 768 || $svg.style.display === 'none') {
                return;
            }

            resetCanvasSize();
            resetDropletPath();

            $circle.setAttribute('r', circleRadius);
            $svg.style.display = 'block';

            window.addEventListener('mousemove', mouseMoveEventListener);
            window.addEventListener('resize', resetCanvasSize);
        }
        init();

    })(jQuery);
});