<?php
$rk = new RdKafka\Producer();
$rk->setLogLevel(LOG_DEBUG);
$rk->addBrokers("10.0.2.15:9092");

$topic = $rk->newTopic("test");

for ($i = 0; $i < 10; $i++) {
		    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message $i");
			    $rk->poll(0);
}

while ($rk->getOutQLen() > 0) {
		    $rk->poll(50);
}
