Symfony Liip RAD Edition
========================

This is the Symfony RAD (Rapid Application Development) Edition by [Liip](http://www.liip.ch).
It's goal is to have an optimized setup including all the bundles we use regularly and making easy to add less-used but
recurring functionality.

The Symfony Liip RAD Edition includes

* The [Guzzle Bundle](https://github.com/misd-service-development/guzzle-bundle), an HTTP client
* [Doctrine Migrations](https://github.com/doctrine/DoctrineMigrationsBundle)


Definition of Done
------------------------

- Follow Symfony2, PSR-1/PSR-2 conventions
- Unit testing for algorithms, functional testing for the output format
- New features should be developed in feature branches
- Changes are proposed via pull requests:
  - PRs include unit/functional tests, markdown docs
  - PRs should be opened as early as possible, but marked as "work in progress" via a [WIP] prefix in the PR title
  - if a PR is ready for review, the given developer should find someone else to review
  - if possible developers should try to get different people to review their PRs
- PHPDoc should be added to methods, short description to classes, more detailed instructions are put in markdown files in `doc/`


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