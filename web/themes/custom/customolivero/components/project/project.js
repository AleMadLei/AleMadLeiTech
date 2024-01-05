((Drupal) => {

  'use strict'

  Drupal.behaviors.projectsInit = {
    attach: (context, settings) => {
      once('projects-init', '.project', context).forEach(p => {
        p.querySelector('.project__links-trigger').addEventListener('click', e => {
          const button = e.currentTarget;
          button.classList.add('hidden');
          button.setAttribute('aria-expanded', 'false');
          const links = e.currentTarget.nextElementSibling;
          links.classList.remove('hidden');
        });
      });
    }
  }
})(Drupal);
