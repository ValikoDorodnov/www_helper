package main

import (
	"context"
	"fmt"
	"go.uber.org/goleak"
	"math/rand"
	"testing"
	"time"
)

type Pair struct {
	src, res string
}

func main() {
	t1 := time.Now()
	ctx, cancel := context.WithTimeout(context.Background(), 2*time.Second)
	defer cancel()

	c1 := generate(ctx)
	c2 := reverse(ctx, c1)
	printResult(ctx, c2)

	t2 := time.Now()
	diff := t2.Sub(t1)
	fmt.Println(diff)
}

func generate(ctx context.Context) <-chan string {
	out := make(chan string)
	go func() {
		defer close(out)
		for {
			select {
			case out <- randomWord(5):
			case <-ctx.Done():
				return
			}
		}
	}()
	return out
}

func reverse(ctx context.Context, in <-chan string) <-chan Pair {
	out := make(chan Pair)
	go func() {
		defer close(out)
		for word := range in {
			select {
			case out <- Pair{word, reverseWord(word)}:
			case <-ctx.Done():
				return
			}
		}
	}()
	return out
}

func printResult(ctx context.Context, in <-chan Pair) {
	for {
		select {
		case pair, ok := <-in:
			if !ok {
				return
			}
			fmt.Println(pair.src, "->", pair.res)
		case <-ctx.Done():
			return
		}
	}
}

func reverseWord(word string) string {
	n := len(word)
	reversed := make([]rune, n)
	for i, char := range word {
		reversed[n-i-1] = char
	}
	return string(reversed)
}

func randomWord(n int) string {
	const letters = "aeiourtnsl"
	chars := make([]byte, n)
	for i := range chars {
		chars[i] = letters[rand.Intn(len(letters))]
	}
	return string(chars)
}

func TestMain(m *testing.M) {
	goleak.VerifyTestMain(m)
}
