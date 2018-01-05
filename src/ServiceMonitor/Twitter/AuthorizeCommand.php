<?php

namespace ServiceMonitor\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AuthorizeCommand extends Command
{
    protected function configure()
    {
        $this->setName('authorize');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connection = new TwitterOAuth(
            getenv('TWITTER_CONSUMER_KEY'),
            getenv('TWITTER_CONSUMER_SECRET')
        );

        $oauthToken= $connection->oauth('oauth/request_token')['oauth_token'];
        $url = $connection->url('oauth/authenticate', ['oauth_token' => $oauthToken]);
        $output->writeln('');

        $output->writeln(sprintf('<info>AUTHORIZE URL</info> : %s', $url));
        $output->writeln('');

        $question = new Question('<question>ENTER PIN CODE :</> ');
        $helper = $this->getHelper('question');
  			$pinCode = $helper->ask($input, $output, $question);
        $output->writeln('');

        $accessToken = $connection->oauth(
            'oauth/access_token',
            ['oauth_token' => $oauthToken, 'oauth_verifier' => $pinCode]
        );

        $output->writeln(sprintf('<info>USER_ID</info>   : <comment>%s</comment>', $accessToken['user_id']));
        $output->writeln(sprintf('<info>USER_NAME</info> : <comment>%s</comment>', $accessToken['screen_name']));
        $output->writeln('');

        $output->writeln(sprintf('<info>TWITTER_ACCESS_TOKEN<info>        : <comment>%s</comment>', $accessToken['oauth_token']));
        $output->writeln(sprintf('<info>TWITTER_ACCESS_TOKEN_SECRET<info> : <comment>%s</comment>', $accessToken['oauth_token_secret']));
        $output->writeln(sprintf('<info>TWITTER_CONSUMER_KEY<info>        : <comment>%s</comment>', getenv('TWITTER_CONSUMER_KEY')));
        $output->writeln(sprintf('<info>TWITTER_CONSUMER_SECRET<info>     : <comment>%s</comment>', getenv('TWITTER_CONSUMER_SECRET')));
    }
}
