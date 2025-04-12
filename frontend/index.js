function loadScripts() {
    const buttons = document.querySelectorAll('.clickable-like');
    buttons.forEach(button => {
        button.addEventListener('click', async function(e) {
            const fillUp = async function(button, bubleDeligate, increeseDeligate) {
                const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));

                const newElement = document.createElement('img');
                newElement.classList.add('like-ico');

                let liked = button.dataset.liked == "true" ? true : false;
                button.dataset.liked = !liked;

                newElement.src = liked 
                    ? './assets/heart.png' 
                    : './assets/heart-full.png';
            
                button.innerHTML = '';
                button.appendChild(newElement);

                if(!liked) {
                    increeseDeligate(button.dataset.id, 1)
                    for (let i = 0; i < 3; i++) {
                        bubleDeligate();
                        await delay(200);
                      }
                }
                else {
                    increeseDeligate(button.dataset.id, -1)
                }
            };
            
            const increeseLikes = (objectId, amount) => {
                const object = document.getElementById("amount-" + objectId);
                object.innerHTML = parseInt(object.innerHTML) + amount;
            }

            const buble = () => {
              const newElement = document.createElement('div');
              newElement.classList.add('flow-element');
          
              newElement.style.left = `${(Math.random() * (0 + 60) - 30) + e.x}px`; 
              newElement.style.top = `${(Math.random() * (0 + 60) - 30) + e.y}px`; 
          
              document.body.appendChild(newElement);
          
              newElement.addEventListener('animationend', () => {
                newElement.remove();
              });
            };
          
            fillUp(button, buble, increeseLikes);
          });
    }) 
}


