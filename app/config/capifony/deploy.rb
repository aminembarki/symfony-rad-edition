#########################
# Adjust the following settings to fit your server/application
# You MUST adjust the following four settings, as they're specific to your server setup.

#
# Set a name for your applicaton
set :application,       "set your application name here"

#
# Set the URL to your git repository.
# Your server will need to be able to check out from here.
set :repository,        "https://github.com/liip/symfony-rad-edition.git"

#
# The settings above MUST be adjusted as they're specific to your project.
#
#########################
#
# The settings below can be adjusted to your server setup.
# You may need to uncomment the setting first.
#

#
# Don't use sudo when deploying
set :use_sudo,          false

#
# Use a different user to connect via SSH
# If this is commented then your current user will be used
# set :user,              "deployer"


#
# Set the ORM system you're using
# Allowed are `doctrine` or `propel`
set :model_manager,     "doctrine"

#
# Run database migrations, if any
# before "symfony:cache:warmup", "symfony:doctrine:migrations:migrate"

#
# Set files that should be shared between releases
set :shared_files,      ["app/config/parameters.yml"]

#
# The logs and the /web/uploads folder are shared by default.
# Adjust the shared_children variable if you want to share additional folders
# set :shared_children,   [log_path, web_path + "/uploads"]

#
# Get more verbose output - helpful when debugging
# logger.level = Logger::MAX_LEVEL


#
#
#########################
#
# The settings below usually don't need to be changed
#

set :stages,         %w(production staging)
set :default_stage,  "staging"
set :stage_dir,      "app/config/capifony"
require 'capistrano/ext/multistage'

set :dump_assetic_assets, true
set :use_composer,        true
set :app_path,            "app"

set  :keep_releases,      3

set :scm,                 :git
# Or `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

load 'app/config/capifony/tasks.rb'
