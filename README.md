Symfony Liip RAD Edition
========================

This is the Symfony RAD (Rapid Application Development) Edition by [Liip](http://www.liip.ch).
It's goal is to have an optimized setup including all the bundles we use regularly and making easy to add less-used but
recurring functionality.

The Symfony Liip RAD Edition includes

* The [Guzzle Bundle](https://github.com/misd-service-development/guzzle-bundle), an HTTP client
* [Doctrine Migrations](https://github.com/doctrine/DoctrineMigrationsBundle)


Coding Standards
------------------------

As this is a symfony project, it is recommended to also follow the core [symfony coding standards](http://symfony.com/doc/current/contributing/code/standards.html) here as well.


Development Workflow
------------------------

- Changes (new features and fixes) should be developed in branches
- These changes are proposed via pull requests
- PRs should be opened as early as possible, but marked as "work in progress" via a [WIP] prefix in the PR title
- If a PR is ready, the developer
  - is resposible that the PR is mergeable (no conflicts),
  - should remove the [WIP],
  - find someone else to review (should not always be the same, if possible)


Definition of Done
------------------------

- You are happy with the code you produced and further refactoring is not needed at this moment
- The changes are reviewed by another developer (or produced with pair programming)
- Coding Standards are followed
- Unit/functional tests written and passing
- Documentation in form of PHPDocs for methods and classes
- Relevant documentation/diagrams produced and/or updated (e.g. markdown files)
- Any build/deployment/configuration changes are implemented/documented/communicated
- Merged into master branch by reviewer
- The change is deployed to a staging server
- Task in issue tracker is task resolved


Installation
------------------------
- Clone the repository
- Run `vagrant up`
- Wait for the script to finish, then go to ... and see if it works
- ...


Deployment with Capifony
------------------------

[Capifony](http://capifony.org/) is a Symfony-flavored extension of Capistrano, an automated deployment tool.
To use Capifony, you'll first need to install it through RubyGems, by running:
    gem install capifony

Adjust the `app/config/deploy.rb` file to match your server settings. The most common configuration options are
commented in the deploy.rb File, more extensive documentation is available for [Capistrano-](http://capifony.org/reference/capistrano.html)
and [Symfony-specific](http://capifony.org/reference/symfony.html) config options.

Next, initialize capifony on the server by running
    cap deploy:setup

Set up the parameters.yml file on the server by manually connecting to the server and adding a parameters.yml
 file in the `[project root]/shared/app/config/` folder. Copy the content of your `app/config/parameters.yml.dist` file
 and adjust it as necessary. You'll always want to adjust at least the `secret` variable.

To actually deploy a version, run
    cap deploy

For more help on using Capifony see the [Capifony site](http://capifony.org/).
