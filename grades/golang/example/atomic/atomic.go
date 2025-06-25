package main

import (
	"fmt"
	"sync"
	"sync/atomic"
)

type Total struct {
	value atomic.Int32
}

func (t *Total) Increment() {
	t.value.Add(1)
}

func (t *Total) Value() int {
	return int(t.value.Load())
}

func main() {
	var wg sync.WaitGroup

	var total Total

	for i := 0; i < 5; i++ {
		wg.Add(1)
		go func() {
			defer wg.Done()
			for i := 0; i < 10000; i++ {
				total.Increment()
			}
		}()
	}

	wg.Wait()
	fmt.Println("total", total.Value())
}
