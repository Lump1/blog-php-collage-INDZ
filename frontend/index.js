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
                    addLike(button.dataset.id);
                    for (let i = 0; i < 3; i++) {
                        bubleDeligate();
                        await delay(200);
                      }
                }
                else {
                    increeseDeligate(button.dataset.id, -1);
                    removeLike(button.dataset.id);
                }
            };
            
            const increeseLikes = (objectId, amount) => {
                const object = document.getElementById("amount-" + objectId);
                object.innerHTML = parseInt(object.innerHTML) + amount;

                fetch('db_worker.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'postId=' + objectId + '&amount=' + amount
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating likes.');
                });
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


function getCookies() {
    let cookies = {};
    document.cookie.split(';').forEach(function(cookie) {
        let [key, value] = cookie.split('=');
        cookies[key.trim()] = value;
    });
    return cookies;
}

function addLike(postId) {
    let cookies = getCookies();
    let likes = cookies['liked_posts'] ? JSON.parse(cookies['liked_posts']) : [];
    
    if (!likes.includes(postId)) {
        likes.push(postId);
        document.cookie = `liked_posts=${JSON.stringify(likes)}; path=/; max-age=31536000`;
    }
}

function removeLike(postId) {
    let cookies = getCookies();
    let likes = cookies['liked_posts'] ? JSON.parse(cookies['liked_posts']) : [];
    
    const index = likes.indexOf(postId);
    if (index > -1) {
        likes.splice(index, 1);
        document.cookie = `liked_posts=${JSON.stringify(likes)}; path=/; max-age=31536000`;
    }
}
