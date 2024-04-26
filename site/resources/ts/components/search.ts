document.addEventListener("DOMContentLoaded", () => {
  const filtro: HTMLInputElement | null = document.getElementById('filtro') as HTMLInputElement;
  let debounceTimeout: number;

  function loadData(url: string) {
      fetch(url, {
          method: 'GET',
          headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'text/html',
          },
      })
      .then(response => response.text())
      .then(html => {
          const tempDiv = document.createElement('div');
          tempDiv.innerHTML = html;

          const newTbody = tempDiv.querySelector('table tbody');
          const currentTbody = document.querySelector('#table-container table tbody');
          if (newTbody && currentTbody) {
              currentTbody.innerHTML = newTbody.innerHTML;
          }

          const newPagination = tempDiv.querySelector('.pagination__box');
          const currentPagination = document.querySelector('.pagination__box');
          if (newPagination && currentPagination) {
              currentPagination.innerHTML = newPagination.innerHTML;
          }

          bindPaginationLinks();
      })
      .catch(error => {
          console.error('Fetch error:', error.message);
      });
  }

  function bindPaginationLinks() {
      document.querySelectorAll('.pagination__box a').forEach(link => {
          link.addEventListener('click', (e) => {
              e.preventDefault();
              const pageUrl = (e.target as HTMLAnchorElement).href;
              const searchValue = filtro ? filtro.value : '';
              const baseUrl = window.location.href.split('?')[0];
              const newUrl = `${baseUrl}?search=${encodeURIComponent(searchValue)}&${pageUrl.split('?')[1]}`;

              loadData(newUrl);
          });
      });
  }

  bindPaginationLinks();

  if (filtro !== null) {
      filtro.addEventListener('input', function() {
          clearTimeout(debounceTimeout);
          debounceTimeout = window.setTimeout(() => {
              const searchValue: string = filtro.value;
              const baseUrl: string = window.location.href.split('?')[0];
              const newUrl: string = `${baseUrl}?search=${encodeURIComponent(searchValue)}`;

              loadData(newUrl);
          }, 300);
      });
  }
});