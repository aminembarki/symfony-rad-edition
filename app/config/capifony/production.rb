#########################
# Adjust the following settings to fit your server/application
# You MUST adjust the following four settings, as they're specific to your server setup.

#
# Set the server values for this environment
server 'production.example.org', :app, :web, :primary => true

#
# Set the absolute path the application should be deployed to on your server
set :deploy_to,   "/var/www/production.example.org"

#
# The settings above MUST be adjusted as they're specific to your project.
#
#########################
#
# The settings below can be adjusted to your server setup.
# You may need to uncomment the setting first.
#

#
# Set the branch that should be deployed
set :branch,      "master"
