#include<semaphore.h>
#include<pthread.h>
#include<stdio.h>

#define MAX 9
sem_t x,y,z,wsem,rsem;
int readcount=0,writecount=0;
int bufer=0;
void* reader(void * arg)
{
	int i;
	i=(int)arg;
	
	sem_wait(&z);
	sem_wait(&x);
	
	readcount++;
	if(readcount==1)
		sem_wait(&wsem);
	sem_post(&x);
	sem_post(&z);
	
	sem_wait(&rsem);	
	printf("\nREADER : %d val : %d readcount : %d ",i,bufer,readcount);
	sem_post(&rsem);
	
	sem_wait(&x);
	readcount--;
	if(readcount==0)
		sem_post(&wsem);
	sem_post(&x);
	
	pthread_exit(NULL);
}

void* writer(void * arg)
{
	int i;
	
	i=(int)arg;	
	
	sem_wait(&y);				///acq lock for writecount variable.........
	writecount++;
	if(writecount==1)
		sem_wait(&rsem);
	sem_post(&y);
	
	sem_wait(&wsem);
	bufer=random()%999;
	printf("\nWRITER : %d val : %d writecount : %d ",i,bufer,writecount);
	sem_post(&wsem);

	sem_wait(&y);
	writecount--;
	if(writecount==0)
		sem_post(&rsem);
	sem_post(&y);

}

int main()
{
	
	pthread_t r[MAX],w[MAX];
	int i;
	sem_init(&x,0,1);
	sem_init(&wsem,0,1);
	sem_init(&y,0,1);
	sem_init(&rsem,0,1);
	sem_init(&z,0,1);

	for(i=0;i<MAX;i++)
	{
		pthread_create(&w[i],NULL,writer,(void *)i);
		pthread_create(&r[i],NULL,reader,(void *)i);		
	}
		
	for(i=0;i<MAX;i++)
		pthread_join(w[i],NULL);	
	for(i=0;i<MAX;i++)
		pthread_join(r[i],NULL);
	return 0;
}

