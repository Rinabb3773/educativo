const discussions = document.querySelectorAll('.discussion');

for (let i = 0; i < discussions.length; i++) {
  const discussion = discussions[i];
  const title = discussion.querySelector('h3');
  const description = discussion.querySelector('p');
  
  title.addEventListener('click', function() {
    description.classList.toggle('hidden');
  });
}
