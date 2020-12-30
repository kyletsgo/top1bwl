function onOri() {
    if (typeof DeviceOrientationEvent.requestPermission === 'function') {
        DeviceOrientationEvent.requestPermission()
            .then(permissionState => {
                if (permissionState === 'granted') {
                    device();
                    onStep_1.leave();
                }
            }).catch(console.error);
    } else {
        device();
        onStep_1.leave();
    }
}

function device() {
    window.addEventListener('deviceorientation', () => {
        var alpha = event.alpha,
            beta = event.beta,
            gamma = event.gamma;

        // console.log(beta);
        if (-10 < beta && beta < 90 && -40 < gamma && gamma < 40 ) {
            TweenMax.set($(".layer__1"), { x: gamma * 1.2, y: (beta - 50) * 1.2 });
            TweenMax.set($(".layer__2"), { x: gamma * 0.9, y: (beta - 50) * 0.9 });
            TweenMax.set($(".layer__3"), { x: gamma * 0.6, y: (beta - 50) * 0.6 });
            TweenMax.set($(".layer__4"), { x: gamma * 0.3, y: (beta - 50) * 0.3 });

        }
    });
}