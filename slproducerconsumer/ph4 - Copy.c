
#define SIZE 3
#define ITEMS 10

#include <stdlib.h>
#include <stdio.h>
#include <pthread.h>
#include <semaphore.h>

pthread_mutex_t mutex;

sem_t lock1, unlock1;
sem_t full, empty;


int stack[SIZE];

/* buffer cnt */
int cnt;

pthread_t pid,cid;       
pthread_attr_t attr; 

void *producer(void *param); 
void *consumer(void *param); 

void initializeData() 
{
   	pthread_mutex_init(&mutex, NULL);

   	sem_init(&full, 0, 0);

   	sem_init(&empty, 0, SIZE-1);
	

   //	pthread_attr_init(&attr);
   	cnt = 0;
}

/* Producer Thread */
void *producer(void *param) 
{
   	int item;

   	while(1) 
	{
		int rNum = 1;
      		sleep(rNum);

      		item = ITEMS;
      		
      		pthread_mutex_lock(&mutex);
                   sem_wait(&full);
      		if(push(item)) 
		{
		 	printf("\n Stack Full so producer has to wait.........!!");
		}
      		else 
        	 	printf("\nproducer produced : %d\n", item);
      		sem_post(&empty);
      		pthread_mutex_unlock(&mutex);
      		
   	}
}

/* Consumer Thread */
void *consumer(void *param) 
{

   	int item;

   	while(1) 
	{
      		
      		int rNum =2;
      		sleep(rNum);

      		item = ITEMS;

      		pthread_mutex_lock(&mutex);
		sem_wait(&empty);
      		if(pop(&item))
		{
                 	

 
		 	printf(" \n Stack Empty......!!!");
		}
      		else 
        	 	printf("Consumer consumed : %d\n", item);
      		sem_post(&full);
      		pthread_mutex_unlock(&mutex);      		
      		
   	}
}


int push(int item) 
{
   	
   	if(cnt < SIZE) 
	{
      		stack[cnt] = item;
      		cnt++;
      		return 0;
   	}
   	else  
      		return 1;   	
}


int pop(int *item) 
{
   
   	if(cnt > 0) 
	{
      		*item = stack[(cnt-1)];
      		cnt--;
      		return 0;
   	}
   	else 
      		return 1;
   
}

int main() 
{
   	initializeData();
	sem_init(&lock1,0,0);
  	sem_init(&unlock1,0,0);
   	pthread_create(&pid,NULL,producer,NULL);
   
        pthread_create(&cid,NULL,consumer,NULL);
   
   	pthread_join(pid,NULL);
	pthread_join(cid,NULL);
   

	//sem_destroy(&full);
	//sem_destroy(&empty);

   	exit(0);
}
